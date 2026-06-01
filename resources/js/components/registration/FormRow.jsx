export default function FormRow({
    label,
    fieldLabel,
    name,
    value,
    error,
    maxLength,
    onChange,
}) {
    const lengthError = value.length > maxLength ? `${fieldLabel}は${maxLength}文字以内で入力してください` : '';
    const errorMessage = lengthError || error;
    return (
        <div className="form-row">
            <label>{label}<span className="must">※必須</span></label>
            <input type="text" name={name} value={value} onChange={onChange} />
            {errorMessage && <p className="error-msg">{errorMessage}</p>}
        </div>
    );
}
