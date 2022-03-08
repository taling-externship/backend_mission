const Task = (props) => {
    const handleChange = (id) => {
        props.toggleTask(id);
    };

    const handleX = (id) => {
        props.handleX(id);
    };

    return (
        <li className="task-item">
            <input
                type="checkbox"
                checked={props.task.checked}
                onChange={() => handleChange(props.task.id)}
            />
            <p className={props.task.checked ? "done" : ""}>
                {props.task.description}
            </p>
            <button onClick={() => handleX(props.task.id)}>✖️</button>
        </li>
    );
};

export default Task;
