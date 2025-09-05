import React, { useState, useEffect } from 'react';
import api from '../api';
import { useHistory } from 'react-router-dom';

interface Role {
    id: number;
    name: string;
}

const UserForm: React.FC = () => {
    const [fullName, setFullName] = useState<string>('');
    const [email, setEmail] = useState<string>('');
    const [roles, setRoles] = useState<number[]>([]);
    const [availableRoles, setAvailableRoles] = useState<Role[]>([]);
    const [error, setError] = useState<string | null>(null); // State for error messages
    const [isSubmitting, setIsSubmitting] = useState<boolean>(false); // State to track submission
    const history = useHistory();

    useEffect(() => {
        const fetchRoles = async () => {
            try {
                const response = await api.get('/roles'); // Adjust the endpoint as necessary
                setAvailableRoles(response.data.data); // Assuming response.data is an array of roles
            } catch (error) {
                console.error('Error fetching roles:', error);
            }
        };

        fetchRoles();
    }, []);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true); // Set submitting state to true
        setError(null); // Reset error state before submission
        try {
            await api.post('/users', {
                full_name: fullName,
                email,
                roles,
            });
            history.push('/users/list'); // Redirect to users page
        } catch (error : any) {
            if (error.response) {
                // Handle error response from the server
                const errorMessage = error.response.data.errors[0].message || 'An error occurred';
                setError(errorMessage);
            } else {
                console.error('Error creating user:', error);
                setError('An unexpected error occurred. Please try again.');
            }
        } finally {
            setIsSubmitting(false); // Reset submitting state
        }
    };

    const handleRoleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const selectedOptions = Array.from(e.target.selectedOptions, option => Number(option.value));
        setRoles(selectedOptions);
    };

    return (
        <div className="min-h-screen bg-gray-100 flex items-center justify-center">
            <div className="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
                <h2 className="text-2xl font-bold mb-4 text-center">Create User</h2>

                {/* Error Message Display */}
                {error && (
                    <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong className="font-bold">Error!</strong>
                        <span className="block sm:inline"> {error}</span>
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label className="block text-gray-700">Full Name:</label>
                        <input
                            type="text"
                            value={fullName}
                            onChange={(e) => setFullName(e.target.value)}
                            required
                            className="mt-1 block w-full border border-gray-300 rounded-md p-2"
                        />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700">Email:</label>
                        <input
                            type="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                            className="mt-1 block w-full border border-gray-300 rounded-md p-2"
                        />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700">Roles:</label>
                        <select
                            multiple
                            value={roles.map(String)} // Convert number array to string array for the select value
                            onChange={handleRoleChange}
                            className="mt-1 block w-full border border-gray-300 rounded-md p-2"
                        >
                            {availableRoles.map((role) => (
                                <option key={role.id} value={role.id}>
                                    {role.name}
                                </option>
                            ))}
                        </select>
                    </div>
                    <button 
                        type="submit" 
                        className={`bg-blue-500 text-white rounded-md px-4 py-2 w-full ${isSubmitting ? 'opacity-50 cursor-not-allowed' : ''}`} 
                        disabled={isSubmitting} // Disable button while submitting
                    >
                        {isSubmitting ? 'Submitting...' : 'Submit'}
                    </button>
                </form>
            </div>
        </div>
    );
};

export default UserForm;