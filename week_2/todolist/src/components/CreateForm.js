import React from "react";

const CreateForm = (props) => {
    const [task, setTask] = React.useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        props.addTask(task);
        setTask("");
    };

    const handleChange = (e) => {
        setTask(e.target.value);
    };

    return (
        <div className="my-8 ">
            <form
                className="form flex rounded-md overflow-hidden"
                onSubmit={handleSubmit}
            >
                <input
                    type="text"
                    className="block w-full p-3"
                    value={task}
                    onChange={handleChange}
                />
                <input
                    type="submit"
                    value="➕"
                    className="bg-blue-500 text-white p-1"
                />
            </form>
        </div>
    );
};

export default CreateForm;
