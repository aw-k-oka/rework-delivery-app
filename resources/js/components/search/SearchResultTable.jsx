import React from 'react';

/** 一覧画面の表の1セル最大文字数 */
const MAX_TEXT_LENGTH = 10;

/**
 * 指定文字数を超えた文字列を省略「...」表示
 * @param {string} text 対象文字列
 * @returns {string}
 */
const truncate = (text) => {
    return text.length > MAX_TEXT_LENGTH ? text.slice(0, MAX_TEXT_LENGTH) + '...' : text;
};

/**
 * 検索結果の一覧表示
 * @param {Object[]} shipments 配送情報一覧
 * @returns {React.JSX.Element}
 */
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
                    <td>{truncate(shipment.staff_name ?? '')}</td>
                    <td>{truncate(shipment.receiver_name)}</td>
                    <td>{truncate(shipment.receiver_address)}</td>
                </tr>
                ))}
            </tbody>
        </table>
    );
}
