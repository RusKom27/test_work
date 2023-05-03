import {useState} from "react";
import {Form} from "react-bootstrap";

const DefaultFormGroup = (
    {
        type="text",
        placeholder="",
        label="",
        name="",
        error=""
    }) => {
    const [value, setValue] = useState("");

    const onChange = (e) => {
        setValue(e.target.value);
    };

    return (
        <Form.Group className="mb-3">
            <Form.Label>{label}</Form.Label>
            <Form.Control
                type={type}
                placeholder={placeholder}
                name={name}
                onChange={onChange}
                value={value}
            />
            <div className={"invalid-feedback d-block"}>{error}</div>
        </Form.Group>
    )
}

export default DefaultFormGroup;