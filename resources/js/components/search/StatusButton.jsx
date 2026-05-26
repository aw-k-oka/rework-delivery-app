export default function StatusButton({ onClick, disabledFlg, label }) {
    return (
        <button type="button" onClick={onClick} disabled={disabledFlg}>{label}</button>
    );
}
