const display_type = document.querySelector("#display");
const type_filter = document.querySelector("#type");
const caracteristique_filter = document.querySelector("#caracteristique");

async function dp_data() {
  console.log(display_type.value);
  console.log(caracteristique_filter.value);
  console.log(type_filter.value);
  let result = await fetch(`../../php/Filter.php?caracteristique=${caracteristique_filter.value}&type=${type_filter.value}`).then(data => data.json());
  const template = document.querySelector("#elementTemplate");
  const table = document.querySelector(".table");
  table.innerHTML = "";
  const distinct_meridian = new Set;
  result.forEach(async (item) => {
    const item_template = template.content.cloneNode(true);
    const element = item_template.firstElementChild;

    if (display_type.value == "meridian") {
      if (!distinct_meridian.has(item.nom_mer)){       
        element.onclick = (event) => fetchPatho(event, item.nom_mer);    
        let title = item_template.querySelector("h1");
        title.innerHTML = item.nom_mer;
        let desc = item_template.querySelector("p");
        desc.innerHTML = item.element_mer;
        let element_meridian = item_template.querySelector("h3");
        element_meridian.innerHTML = item.element_mer;
        table.appendChild(item_template);
        distinct_meridian.add(item.nom_mer);
      }
    } else {
        element.onclick = () => { let a }; 
        let title = item_template.querySelector("h1");
        title.innerHTML = item.description_symptome;
        let desc = item_template.querySelector("p");
        desc.innerHTML = "";
        item_template.querySelector(".fa-chevron-down").style.display = "none";
        table.appendChild(item_template);
        distinct_meridian.add(item.nom_mer);

    }
  });
}

display_type.addEventListener("change", dp_data);
caracteristique_filter.addEventListener("change", dp_data);
type_filter.addEventListener("change", dp_data);
