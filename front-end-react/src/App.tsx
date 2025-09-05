import React from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect } from 'react-router-dom';
import UserForm from './components/UserForm';
import UserList from './components/UserList';

const App: React.FC = () => {
    return (
        <Router>
            <Switch>
                <Route path="/" exact>
                    <Redirect to="/users/list" /> {/* Redirect from root to /users/list */}
                </Route>
                <Route path="/users/list" component={UserList} />
                <Route path="/users/create" component={UserForm} />
                <Redirect to="/" /> {/* Redirect any unknown routes to the root */}
            </Switch>
        </Router>
    );
};

export default App;