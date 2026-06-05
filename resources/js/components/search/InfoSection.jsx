import InfoRow from "./InfoRow";

/**
 * 配送情報の1ブロック単位
 * @param {string} label 項目名
 * @param {string} name 氏名
 * @param {string} address 住所
 * @returns {React.JSX.Element}
 */
export default function InfoSection({ label, name, address }) {
    return (
        <>
            <label>{label}</label>
            <InfoRow label='氏名' content={name} />
            <InfoRow label='住所' content={address} />
        </>
    );
}
