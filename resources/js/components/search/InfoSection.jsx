import InfoRow from "./InfoRow";

export default function InfoSection({ label, name, address }) {
    return (
        <>
            <label>{label}</label>
            <InfoRow label='氏名' content={name} />
            <InfoRow label='住所' content={address} />
        </>
    );
}
