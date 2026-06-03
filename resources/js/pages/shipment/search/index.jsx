import React from 'react';
import ReactDOM from 'react-dom/client';

import SearchForm from "../../../components/search/SearchForm";
import SearchResultTable from "../../../components/search/SearchResultTable";

// ソート用定数
const TRACKING_NUMBER_DESC = 'tracking_number_desc';
const TRACKING_NUMBER_ASC = 'tracking_number_asc';
const UPDATE_DATE_DESC = 'update_date_desc';
const UPDATE_DATE_ASC = 'update_date_asc';

const element = document.getElementById("shipment-search");

if (element) {
    const data = element.dataset;
    // ViteのHotReloadによるエラー対策
    const root = window.searchListRoot ?? ReactDOM.createRoot(element);
    window.searchListRoot = root;

    root.render(<SearchPage searchUrl={data.searchUrl} />);
}

/**
 * 配送情報検索ページ
 * @param {string} searchUrl 検索URL
 * @returns
 */
function SearchPage({ searchUrl }) {
    // 検索結果
    const [shipments, setShipments] = React.useState([]);
    // 並べ替え情報
    const [sort, setSort] = React.useState(TRACKING_NUMBER_DESC);

    const sortedShipments = React.useMemo(() => {
        const sorted = [...shipments];
        switch (sort) {
            case UPDATE_DATE_ASC:
                sorted.sort((shipmentA, shipmentB) => new Date(shipmentA.updated_at) - new Date(shipmentB.updated_at));
                break;
            case UPDATE_DATE_DESC:
                sorted.sort((shipmentA, shipmentB) => new Date(shipmentB.updated_at) - new Date(shipmentA.updated_at));
                break;
            case TRACKING_NUMBER_ASC:
                sorted.sort((shipmentA, shipmentB) => shipmentA.tracking_number.localeCompare(shipmentB.tracking_number));
                break;
            case TRACKING_NUMBER_DESC:
            default:
                sorted.sort((shipmentA, shipmentB) => shipmentB.tracking_number.localeCompare(shipmentA.tracking_number));

        }
        return sorted;
    }, [shipments, sort]);

    return (
        <>
            <span>検索条件</span>
            <select className="sort-button" value={sort} onChange={e => setSort(e.target.value)}>
                <option value={TRACKING_NUMBER_DESC}>配送番号_降順</option>
                <option value={TRACKING_NUMBER_ASC}>配送番号_昇順</option>
                <option value={UPDATE_DATE_DESC}>更新日時_降順</option>
                <option value={UPDATE_DATE_ASC}>更新日時_昇順</option>
            </select>
            <SearchForm searchUrl={searchUrl} setShipments={setShipments} />
            <SearchResultTable shipments={sortedShipments} />
        </>
    );
}
