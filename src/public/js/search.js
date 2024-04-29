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

async function fetchPatho(event, name) {
  const element = event.currentTarget;
  if (element.classList.contains("element-toggled")) {
    element.classList.remove("element-toggled");
    return;
  }

  const elements = document.querySelectorAll(".element");
  elements.forEach((el) => {
    el.classList.remove("element-toggled");
  });

  const result = await fetch(`../../php/FetchPatho.php?query=${name}`).then(
    (data) => data.json()
  );

  const randomData = getRandomElements(result, 5);
  const merElement = randomData[0].element_mer;
  let descSympt = "";
  randomData.forEach((data) => {
    descSympt += data.description_symptome + ", ";
  });

  element.querySelector(".element-body p").innerHTML = descSympt;
  element.querySelector(".element-body span").innerHTML =
    merElement != "" ? merElement : "X";
  element.classList.add("element-toggled");
}

async function search() {
  const query = searchBar.value;
  const result = await fetch(`../../php/Search.php?query=${query}`).then(data => data.json());

  const table = document.querySelector(".table");
  table.innerHTML = "";
  const elementTemplate = document.querySelector('#elementTemplate');

  result.forEach(item => {
    const clone = elementTemplate.content.cloneNode(true);
    const element = clone.firstElementChild;
    element.innerHTML = element.innerHTML.replace(/template_title/g, item.nom_mer);
    element.innerHTML = element.innerHTML.replace(/template_description/g, item.description_symptome);
    
    table.appendChild(clone);
  });
}

async function dp_data() {
  console.log(display_type.value);
  console.log(caracteristique_filter.value);
  console.log(type_filter.value);
  let result = await fetch(`../../php/Filter.php?caracteristique=${caracteristique_filter.value}&type=${type_filter.value}`).then(data => data.json());
  const template = document.querySelector("#elementTemplate");
  const table = document.querySelector(".table");
  table.innerHTML = "";

  result.forEach(async (item) => {
    const item_template = template.content.cloneNode(true);
    const element = item_template.firstElementChild;
    element.onclick = (event) => fetchPatho(event, item.nom_mer);
    if (display_type.value == "meridian") {
      let title = item_template.querySelector("h1");
      title.innerHTML = item.nom_mer;
      let desc = item_template.querySelector("p");
      desc.innerHTML = item.element_mer;
      let element = item_template.querySelector("h3");
      element.innerHTML = item.element_mer;
      table.appendChild(item_template);
    }
  });
}

display_type.addEventListener("change", dp_data);
caracteristique_filter.addEventListener("change", dp_data);
type_filter.addEventListener("change", dp_data);
searchBar.addEventListener("change", search);

