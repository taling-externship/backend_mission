import Task from "./Task";

const Tasks = (props) => {
    return (
        <>
            <ul>
                {props.taskList.map((task, idx) => (
                    <Task
                        key={task.id}
                        task={task}
                        toggleTask={props.toggleTask}
                        handleX={props.handleX}
                    />
                ))}
            </ul>
        </>
    );
};

export default Tasks;
