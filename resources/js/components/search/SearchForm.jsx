import React from 'react';

// ソート用定数
const TRACKING_NUMBER_DESC = 'tracking_number_desc';
const TRACKING_NUMBER_ASC = 'tracking_number_asc';
const UPDATE_DATE_DESC = 'update_date_desc';
const UPDATE_DATE_ASC = 'update_date_asc';

export default function SearchForm({ searchUrl, setShipments }) {
    // フォームの入力値
    const [formData, setFormData] = React.useState({
        tracking_number: '',
        receiver_address: '',
        sort: 'tracking_number_desc'
    });

    const handleChange = (event) => {
        setFormData({
            ...formData,
            [event.target.name]: event.target.value,
        });
    };

    const search = async (targetFormData = formData) => {
    try {
        const params = new URLSearchParams({
            tracking_number: targetFormData.tracking_number,
            receiver_address: targetFormData.receiver_address,
            sort: targetFormData.sort,
        });
        const response = await fetch(
            searchUrl + '?' + params.toString(),
            {
                headers: {
                    Accept: 'application/json',
                },
            }
        );
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

    const handleSort = (event) => {
    const newFormData = {
        ...formData,
        sort: event.target.value,
    };
    setFormData(newFormData);
    search(newFormData);
};

    // 初回表示時は全件検索
    React.useEffect(() => {
        search();
    }, []);

    return (
        <>
            <span>検索条件</span>
            <span>
                <select id="sort" name="sort" value={formData.sort} onChange={handleSort}>
                    <option value={TRACKING_NUMBER_DESC}>配送番号_降順</option>
                    <option value={TRACKING_NUMBER_ASC}>配送番号_昇順</option>
                    <option value={UPDATE_DATE_DESC}>更新日時_降順</option>
                    <option value={UPDATE_DATE_ASC}>更新日時_昇順</option>
                </select>
            </span>
            <div className="search-form">
                <label htmlFor="tracking_number">配送番号</label>
                <input id="tracking_number" type="text" name="tracking_number" value={formData.tracking_number} onChange={handleChange} />
                <label htmlFor="receiver_address">届け先住所</label>
                <input id="receiver_address" type="text" name="receiver_address" value={formData.receiver_address} onChange={handleChange} />
                <button className="short-word search-button" type="button" onClick={() => search()}>検索</button>
            </div>
        </>
    );
};
