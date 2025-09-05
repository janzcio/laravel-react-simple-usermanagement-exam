import React, { useEffect, useState } from 'react';
import api from '../api';
import { useHistory } from 'react-router-dom';

interface User {
    id: number;
    full_name: string;
    email: string;
    roles: { id: number; name: string }[];
}

interface RoleGroup {
    [key: string]: User[];
}

const UserList: React.FC = () => {
    const [groupedUsers, setGroupedUsers] = useState<RoleGroup>({});
    const [loading, setLoading] = useState<boolean>(true); // Loading state
    const history = useHistory(); // Use history for navigation

    useEffect(() => {
        const fetchUsers = async () => {
            setLoading(true); // Set loading to true before fetching
            try {
                const response = await api.get('/users');
                const users: User[] = response.data.data;

                const grouped: RoleGroup = {};
                users.forEach((user) => {
                    user.roles.forEach((role) => {
                        if (!grouped[role.name]) {
                            grouped[role.name] = [];
                        }
                        grouped[role.name].push(user);
                    });
                });
                setGroupedUsers(grouped);
            } catch (error) {
                console.error('Error fetching users:', error);
            } finally {
                setLoading(false); // Set loading to false after fetching
            }
        };

        fetchUsers();
    }, []);

    return (
        <div className="container mx-auto p-6 bg-gray-50">
            <h1 className="text-4xl font-bold mb-6 text-center text-gray-800">Users by Role</h1>
            <div className="mb-4 text-center">
                <button
                    onClick={() => history.push('/users/create')} // Redirect to create user page
                    className="bg-green-600 hover:bg-green-700 text-white rounded-md px-6 py-3 transition duration-200 shadow-lg"
                >
                    Create User
                </button>
            </div>

            {loading ? ( // Conditional rendering for loading state
                <div className="text-center">
                    <p className="text-lg text-gray-600">Loading users...</p>
                </div>
            ) : (
                Object.keys(groupedUsers).map((role) => (
                    <div key={role} className="mb-6 bg-white rounded-lg shadow-md overflow-hidden">
                        <h2 className="text-2xl font-semibold text-gray-700 p-4 border-b bg-gray-100">{role}</h2>
                        <ul className="divide-y divide-gray-200">
                            {groupedUsers[role].map((user) => (
                                <li key={user.id} className="flex justify-between items-center p-4 hover:bg-gray-100 transition duration-150">
                                    <div>
                                        <p className="text-lg font-medium text-gray-800">{user.full_name}</p>
                                        <p className="text-sm text-gray-500">{user.email}</p>
                                    </div>
                                    <button className="bg-blue-500 text-white rounded-md px-4 py-2 text-sm transition duration-200 hover:bg-blue-600">
                                        View Details
                                    </button>
                                </li>
                            ))}
                        </ul>
                    </div>
                ))
            )}
        </div>
    );
};

export default UserList;