/**
 * 1項目分の入力フォーム
 * @param {string} label 項目名
 * @param {string} fieldLabel 大項目名
 * @param {string} name inputタグのname属性の値
 * @param {string} value 入力値の初期値
 * @param {string} error バリデーションエラー時のメッセージ
 * @param {number} maxLength 最大文字数
 * @param {Function} onChange 入力時に発火される関数
 * @returns {React.JSX.Element}
 */
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
