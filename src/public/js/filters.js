const display_type = document.querySelector("#display");
const type_filter = document.querySelector("#type");
const caracteristique_filter = document.querySelector("#caracteristique");

async function dp_data() {
  let result = await fetch(`../../php/Filter.php?caracteristique=${caracteristique_filter.value}&type=${type_filter.value}`).then(data => data.json());
  const template = document.querySelector("#elementTemplate");
  const table = document.querySelector(".table");
  table.innerHTML = "";
  const distinct_meridian = new Set;
  result.forEach(async (item) => {
    const item_template = template.content.cloneNode(true);
    const element = item_template.firstElementChild;

    switch(display_type.value) {
      case "meridian":
    
        if (!distinct_meridian.has(item.nom_mer)){       
          element.onclick = (event) => fetchPatho(event, item.nom_mer);    
          let title = item_template.querySelector("h1");
          title.innerHTML = item.nom_mer;
          let desc = item_template.querySelector("p");
          desc.innerHTML = item.element_mer;
          let title3 = item_template.querySelector("h2");
          title3.innerHTML = "Symptomes frequents associes aux pathologies touchant ce meridian :";
          let element_meridian = item_template.querySelector("h3");
          element_meridian.innerHTML = item.element_mer;
          table.appendChild(item_template);
          distinct_meridian.add(item.nom_mer);
        }
        break;
      case "pathologie":
          element.onclick = (event) => fetchPatho(event, item.desc_patho); 
          let title1 = item_template.querySelector("h1");
          title1.innerHTML = item.desc_patho;
          let desc1 = item_template.querySelector("p");
          desc1.innerHTML = "";
          let title4 = item_template.querySelector("h2");
          title4.innerHTML = "Symptomes frequents associes à cette pathologie :";

          table.appendChild(item_template);
          distinct_meridian.add(item.pathologie);

          
        break;
      case "symptome":
        element.onclick = () => { let a }; 
          let title2 = item_template.querySelector("h1");
          title2.innerHTML = item.description_symptome;
          let desc2 = item_template.querySelector("p");
          desc2.innerHTML = "";
          item_template.querySelector(".fa-chevron-down").style.display = "none";
          table.appendChild(item_template);
          distinct_meridian.add(item.nom_mer);
        break;
      }
  });
}

display_type.addEventListener("change", dp_data);
caracteristique_filter.addEventListener("change", dp_data);
type_filter.addEventListener("change", dp_data);
