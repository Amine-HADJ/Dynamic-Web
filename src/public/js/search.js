const searchBar = document.querySelector("#searchbar");
const display_type = document.querySelector("#display");
const caracteristique_filter = document.querySelector("#caracteristique");
const type_filter = document.querySelector("#type");

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

    const result = await fetch(`../../php/FetchPatho.php?query=${name}`)
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

async function search(){
  const query = searchBar.value;
  const result = await fetch(`../../php/Search.php?query=${query}`);

  console.log(result);
}


async function dp_data(){
    console.log(display_type.value);
    console.log(caracteristique_filter.value);
    console.log(type_filter.value);
    //let result = await fetch(`../../php/Filter.php?caracteristique=${caracteristique_filter.value}&type=${type_filter.value}`);            
}

display_type.addEventListener("change", dp_data)
caracteristique_filter.addEventListener("change", dp_data)
type_filter.addEventListener("change", dp_data)
searchBar.addEventListener("change", search)