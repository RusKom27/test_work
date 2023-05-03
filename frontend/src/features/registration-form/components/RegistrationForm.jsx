import {useState} from "react";
import $ from "jquery";
import {Button, Form} from "react-bootstrap";
import {DefaultFormGroup} from "../../../shared";


const RegistrationForm = () => {
    const [isValid, setIsValid] = useState("");
    const [test, setTest] = useState("");
    const [errors, setErrors] = useState({
        "name": "",
        "surname": "",
        "email": "",
        "password": "",
        "repeat_password": "",
    })

    const handleSumbit = (e) => {
        e.preventDefault();
        const form = $(e.target);
        // if (e.target.password.value !== e.target.repeat_password.value) {
        //     console.log("Passwords is not equal!");
        //     return
        // }

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success(data) {
                let parsed_data = JSON.parse(data)
                setErrors(JSON.parse(parsed_data.errors));
                setIsValid(parsed_data.is_valid === "true")
            },
        });
    };
    return (<>
            {isValid && <div className={"d-flex flex-column justify-content-center"}><h1>Registration was successful!</h1></div>}
            {!isValid && <Form
                action="http://localhost:8000/server.php"
                onSubmit={(event) => handleSumbit(event)}
                className={"d-flex flex-column justify-content-center"}
            >
                <DefaultFormGroup
                    type={"text"}
                    placeholder={"Enter name"}
                    label={"Name"}
                    name={"name"}
                    error={errors?.name}
                />
                <DefaultFormGroup
                    type={"text"}
                    placeholder={"Enter surname"}
                    label={"Surname"}
                    name={"surname"}
                    error={errors?.surname}
                />
                <DefaultFormGroup
                    type={"email"}
                    placeholder={"Enter email"}
                    label={"Email address"}
                    name={"email"}
                    error={errors?.email}
                />

                <DefaultFormGroup
                    type={"password"}
                    name={"password"}
                    placeholder={"Enter password"}
                    label={"Password"}
                    error={errors?.password}
                />
                <DefaultFormGroup
                    type={"password"}
                    name={"repeat_password"}
                    placeholder={"Enter password again"}
                    label={"Repeat password"}
                    error={errors?.repeat_password}
                />

                <Button variant="primary" type="submit">
                    Registration
                </Button>
            </Form>}
        </>
    )
}

export default RegistrationForm