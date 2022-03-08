import React from "react";
import CreateForm from "./CreateForm";
import Tasks from "./Tasks";

const Todo = () => {
    const [taskList, setTaskList] = React.useState([]);

    const handleAdd = (task) => {
        setTaskList([task, ...taskList]);
    };

    const toggleTask = (id) => {
        const tasks = taskList.map((t) => {
            return t.id === id ? { ...t, checked: !t.checked } : t;
        });

        setTaskList(tasks);
    };

    const removeTask = (id) => {
        const tasks = taskList.filter((t) => t.id !== id);
        setTaskList(tasks);
    };

    const removeAll = () => {
        setTaskList([]);
    };

    return (
        <main className="container w-full p-8 mx-auto">
            <header>
                <h1 className="text-4xl">TODO LIST</h1>
            </header>
            <section>
                <CreateForm addTask={(task) => handleAdd(task)} />
                <Tasks
                    taskList={taskList}
                    toggleTask={toggleTask}
                    handleX={removeTask}
                />
                <button
                    className="w-full bg-red-700 text-white
                    p-3 rounded-md mt-4
                    "
                    onClick={removeAll}
                >
                    Clear
                </button>
            </section>
        </main>
    );
};

export default Todo;
