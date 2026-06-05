import FormRow from './FormRow';

/**
 * 入力フォーム1単位
 * @param {string} title 項目名
 * @param {string} prefix 項目内容の接頭識別子
 * @param {Object} formData 入力データ
 * @param {Object} errors バリデーションエラー
 * @param {Function} onChange 入力時に発火する関数
 * @param {number} maxNameLength 氏名の最大文字数
 * @param {number} maxAddressLength 住所の最大文字数
 * @returns {React.JSX.Element}
 */
export default function InputSection({
    title,
    prefix,
    formData,
    errors,
    onChange,
    maxNameLength,
    maxAddressLength,
}) {
    const name = '氏名';
    const address = '住所';
    return (
        <section>
            <p>{title}</p>

            <FormRow
                label={`${name}(${maxNameLength}文字)`}
                fieldLabel={name}
                name={`${prefix}_name`}
                value={formData[`${prefix}_name`] ?? ''}
                error={errors[`${prefix}_name`]?.[0]}
                maxLength={maxNameLength}
                onChange={onChange}
            />
            <FormRow
                label={`${address}(${maxAddressLength}文字)`}
                fieldLabel={address}
                name={`${prefix}_address`}
                value={formData[`${prefix}_address`] ?? ''}
                error={errors[`${prefix}_address`] ?? ''}
                maxLength={maxAddressLength}
                onChange={onChange}
            />
        </section>
    );
}
