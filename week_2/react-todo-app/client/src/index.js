import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
const DATA = [
    { id: "todo-0", name: "study", completed: true },
    { id: "todo-1", name: "Sleep", completed: false },
    { id: "todo-2", name: "Repeat", completed: false }
];

ReactDOM.render(<App tasks={DATA}/>, document.getElementById("root"));

reportWebVitals();
