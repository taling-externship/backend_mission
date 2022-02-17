const Tasks = (props) => {
    return (
        <>
            <ul>
                {props.taskList.map((task, idx) => (
                    <li key={idx}>{task}</li>
                ))}
            </ul>
        </>
    );
};

export default Tasks;
