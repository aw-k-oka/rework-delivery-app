import React from 'react';

/** 一覧画面の表の1セル最大文字数 */
const maxTextLength = 10;

export default function SearchResultTable({ shipments }) {
    // 10文字を超えた分は「...」で置き換え
    const truncate = (text) => {
        return text.length > maxTextLength ? text.slice(0, maxTextLength) + '...' : text;
    };

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
                    <td>{truncate(shipment.staff_name ?? '')}</td>
                    <td>{truncate(shipment.receiver_name)}</td>
                    <td>{truncate(shipment.receiver_address)}</td>
                </tr>
                ))}
            </tbody>
        </table>
    );
}
