function getRandomElements(arr, n) {
    const copyArr = arr.slice();
    const result = [];

    let N = n > copyArr.length ? copyArr.length : n;

    while (result.length < N) {
        const randomIndex = Math.floor(Math.random() * copyArr.length);
        const randomElement = copyArr.splice(randomIndex, 1)[0];
        result.push(randomElement);
    }

    return result;
}

async function fetchPatho(event, name){
    const element = event.currentTarget;
    if(element.classList.contains("element-toggled")){
        element.classList.remove("element-toggled");
        return;
    }
    
    const elements = document.querySelectorAll(".element");
    elements.forEach(el => {
        el.classList.remove("element-toggled");
    });

    const result = await fetch(`../../Database/FetchPatho.php?query=${name}`)
        .then(data => data.json());

    const randomData = getRandomElements(result, 5);
    const merElement = randomData[0].element_mer;
    let descSympt = "";
    randomData.forEach(data => {
        descSympt += data.description_symptome + ", ";
    });

    element.querySelector(".element-body p").innerHTML = descSympt;
    element.querySelector(".element-body span").innerHTML = merElement != "" ? merElement : "X";
    element.classList.add("element-toggled");
}

async function search(query){
    const result = await fetch(`../../Database/Search.php?query=${query}`);

    console.log(result);
}


/*
window.addEventListener("load", async () => {
    let data_products = [];
    for (let index = 1; index < 6; index++) {

        const result = await fetch(`https://corsproxy.io/?https://taostar.com/shop-all/?Screen=SFNT&Store_Code=acom&page=${index}`, {
            headers: {
                "cors": "nocors",
            }
        }).then((data_shop) => {
            return data_shop.text();
        })
        const doc = new DOMParser().parseFromString(result, 'text/html');
        const products = doc.querySelectorAll(".product");
        products.forEach(async product => {
            const image = product.querySelector(".card-image").src; 
            const title = product.querySelector(".card-title a").innerHTML.replace();
            const price = product.querySelector(".price--withoutTax").innerHTML;
            const link = product.querySelector(".card-title a ").href;

            await fetch(`https://corsproxy.io/?${link}`)
                .then(async (data_shop) => {
                    const result_item = await data_shop.text();
                    const doc_item = new DOMParser().parseFromString(result_item, 'text/html');
                    const all_span = doc_item.querySelectorAll("span");
                    let description = [];
                    let flag_useless_data = 0;
                    all_span.forEach(span => {
                        if (!span.children.length && !span.innerHTML.includes("\n") ) {
                            if (span.innerHTML == "Pinterest") {
                                flag_useless_data = 1;
                            }else if (span.innerHTML == "Close"){
                                flag_useless_data = 0;
                            }
                            else if (flag_useless_data == 1) {
                                txt = span.innerHTML;
                                all_txt.push(txt);
                            }                                
                        }

                    })
                    data_products.push({
                        image,
                        title,
                        price,
                        description,
                        link
                    })
                })
                .catch(e => {const a = e});
            
        }) 
    }

    const response = await fetch('../../Database/MinedData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data_products)
    });

    const data = response.text();
    console.log(data);
})
*/