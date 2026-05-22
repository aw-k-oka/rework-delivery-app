export default function StatusButtonForm({ action, formClass, csrfToken, shipmentId, buttonClass, disabledFlg, label }) {
    return (
        <form action={action} method="POST" className={formClass}>
            <input type="hidden" name="_token" value={csrfToken} />
            <input type="hidden" name="id" value={shipmentId} />
            <button type="submit" className={buttonClass} disabled={disabledFlg}>{label}</button>
        </form>
    );
}
