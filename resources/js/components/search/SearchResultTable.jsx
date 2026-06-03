import React from 'react';

export default function SearchResultTable({ shipments }) {

    return (
        <table className="search-result">
            <thead className="table-header">
                <tr>
                    <th>配送番号</th>
                    <th>配送状況</th>
                    <th>担当者</th>
                    <th>届け先氏名</th>
                    <th>届け先住所</th>
                </tr>
            </thead>

            <tbody>
                {shipments.map((shipment) => (
                <tr key={shipment.tracking_number}>
                    <td><a href={`/search/result?tracking_number=${shipment.tracking_number}`}>{shipment.tracking_number}</a></td>
                    <td>{shipment.status}</td>
                    <td>{shipment.staff_name ?? ''}</td>
                    <td>{shipment.receiver_name}</td>
                    <td>{shipment.receiver_address}</td>
                </tr>
                ))}
            </tbody>
        </table>
    );
}
