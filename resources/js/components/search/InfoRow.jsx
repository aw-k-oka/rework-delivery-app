export default function InfoRow({ label, content }) {
    return (
        <div className="info-row">
            <label className="info-label">{label}</label>
            <span>{content}</span>
        </div>
    );
}
