/**
 * 見出しと項目
 * @param {string} label 見出し項目名
 * @param {content} content 実際の項目値
 * @returns {React.JSX.Element}
 */
export default function InfoRow({ label, content }) {
    return (
        <div className="info-row">
            <label className="info-label">{label}</label>
            <span>{content}</span>
        </div>
    );
}
