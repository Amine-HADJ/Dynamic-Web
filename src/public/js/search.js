const searchBar = document.querySelector("#searchbar");

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

async function search(){
  const query = searchBar.value;
  const result = await fetch(`../../Database/Search.php?query=${query}`);

  console.log(result);
}

searchBar.addEventListener("change", search(query))