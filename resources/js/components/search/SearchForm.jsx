import React from 'react';
import SearchResultTable from './SearchResultTable';

export default function SearchForm({ searchUrl }) {
    // フォームの入力値
    const [formData, setFormData] = React.useState({
        tracking_number: '',
        receiver_address: ''
    });
    // 検索結果
    const [shipments, setShipments] = React.useState([]);

    const handleChange = (event) => {
        setFormData({
            ...formData,
            [event.target.name]: event.target.value,
        });
    };

    const search = async () => {
        try {
            const params = new URLSearchParams({
                tracking_number: formData.tracking_number,
                receiver_address: formData.receiver_address,
            });
            const response = await fetch(searchUrl + '?' + params.toString());
            const data = await response.json();
            if (!response.ok) {
                console.error(data.message);
                return;
            }
            setShipments(data);
        } catch (e) {
            console.error(e.message);
        }
    };

    // 初回表示時は全件検索
    React.useEffect(() => {
        search();
    }, []);

    return (
        <>
            <p>検索条件</p>
            <div className="search-form">
                <label htmlFor="tracking_number">配送番号</label>
                <input id="tracking_number" type="text" name="tracking_number" value={formData.tracking_number} onChange={handleChange} />
                <label htmlFor="receiver_address">届け先住所</label>
                <input id="receiver_address" type="text" name="receiver_address" value={formData.receiver_address} onChange={handleChange} />
                <button className="short-word search-button" type="button" onClick={search}>検索</button>
            </div>
            <SearchResultTable shipments={shipments} />
        </>
    );
};
