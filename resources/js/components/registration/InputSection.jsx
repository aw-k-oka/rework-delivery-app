import FormRow from './FormRow';

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
