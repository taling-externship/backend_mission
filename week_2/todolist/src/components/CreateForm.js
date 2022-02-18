import React from "react";

const CreateForm = (props) => {
    const [task, setTask] = React.useState({
        id: 1,
        description: "",
        checked: false,
    });

    const [lastId, setLastId] = React.useState(1);

    const handleSubmit = (e) => {
        e.preventDefault();
        setLastId(lastId + 1);
        props.addTask(task);
        setTask({ id: lastId, description: "", checked: false });
    };

    const handleChange = (e) => {
        setTask({ id: lastId, description: e.target.value, checked: false });
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
                    value={task.description}
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
