import React, { useState } from 'react';

import Container from 'react-bootstrap/Container';

import './App.css';
import {RegistrationForm} from "../../features";

const App = () => (
    <Container className="col-lg-6 col-md-8 col-xl-4 p-3">
        <RegistrationForm/>
    </Container>
);

export default App;

