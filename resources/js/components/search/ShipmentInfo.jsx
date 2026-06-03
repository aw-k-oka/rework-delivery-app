import InfoSection from "./InfoSection";
import InfoRow from "./InfoRow";

export default function ShipmentInfo({ shipment }) {
    return (
        <>
            <InfoRow label='配送番号' content={shipment.tracking_number} />
            <InfoRow label='担当者' content={shipment.staff_name} />
            <div>
                <InfoSection label='ご依頼主' name={shipment.client_name} address={shipment.client_address}/>
                <InfoSection label='お届け先' name={shipment.receiver_name} address={shipment.receiver_address} />
            </div>
            <InfoRow label='配送状況' content={shipment.status} />
        </>
    );
}
