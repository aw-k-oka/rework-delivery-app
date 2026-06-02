import React from 'react';
import ReactDOM from 'react-dom/client';

import InputSection from '../../../components/registration/InputSection'

/**
 * JSONから情報を取得
 * @param {string|null|undefined} value
 * @returns {Object|null}
 */
const parseData = (value) => {
    return value ? JSON.parse(value) : {};
};
const element = document.getElementById("registration-form");

if (element) {
    const data = element.dataset;
    // ViteのHotReloadによるエラー対策
    const root = window.registrationRoot ?? ReactDOM.createRoot(element);
    window.registrationRoot = root;

    root.render(
        <RegistrationPage
            confirmUrl={data.confirmUrl}
            csrfToken={data.csrfToken}
            maxNameLength={Number(data.maxNameLength)}
            maxAddressLength={Number(data.maxAddressLength)}
            initialValues={parseData(data.old)}
            errors={parseData(data.errors)}
        />
    );
}

function RegistrationPage({
    confirmUrl,
    csrfToken,
    maxNameLength,
    maxAddressLength,
    initialValues,
    errors,
}) {
    const [formData, setFormData] = React.useState(initialValues);
    const handleChange = (event) => {
        setFormData({
            ...formData,
            [event.target.name]: event.target.value,
        });
    };

    return (
        <form method="POST" action={confirmUrl}>
            <input type="hidden" name="_token" value={csrfToken} />
            <InputSection
                title="ご依頼主"
                prefix="client"
                formData={formData}
                errors={errors}
                onChange={handleChange}
                maxNameLength={maxNameLength}
                maxAddressLength={maxAddressLength}
            />
            <InputSection
                title="お届け先"
                prefix="receiver"
                formData={formData}
                errors={errors}
                onChange={handleChange}
                maxNameLength={maxNameLength}
                maxAddressLength={maxAddressLength}
            />
            <div className="button-area">
                <button className="short-word" type="button" onClick={() => location.href = "/guest"}>戻る</button>
                <button className="short-word" type="submit">確認</button>
            </div>
        </form>
    );
}
