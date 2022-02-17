import React from "react";
import CreateForm from "./CreateForm";
import Tasks from "./Tasks";

const Todo = () => {
    const [taskList, setTaskList] = React.useState([]);

    const handleAdd = (task) => {
        setTaskList([task, ...taskList]);
    };

    return (
        <main className="container w-full p-8 mx-auto">
            <header>
                <h1 className="text-4xl">TODO LIST</h1>
            </header>
            <section>
                <CreateForm addTask={(task) => handleAdd(task)} />
                <Tasks taskList={taskList} />
            </section>
        </main>
    );
};

export default Todo;
