import React from 'react';
import ReactDOM from 'react-dom/client';

import SearchForm from "../../../components/search/SearchForm";
import SearchResultTable from "../../../components/search/SearchResultTable";

const element = document.getElementById("shipment-search");

if (element) {
    const data = element.dataset;
    // ViteのHotReloadによるエラー対策
    const root = window.searchListRoot ?? ReactDOM.createRoot(element);
    window.searchListRoot = root;

    root.render(<SearchPage searchUrl={data.searchUrl} />);
}

function SearchPage({ searchUrl }) {
    // 検索結果
    const [shipments, setShipments] = React.useState([]);
    return (
        <>
            <SearchForm searchUrl={searchUrl} setShipments={setShipments} />
            <SearchResultTable shipments={shipments} />
        </>
    );
}
