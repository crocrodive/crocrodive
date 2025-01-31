import axios from "axios";

const showCourses = document.getElementById("createCourseBtn");
const createCourseForm = document.getElementById("createCourseModal");
const listCourse = document.getElementById("listCourse");

const locationSelect = document.getElementById("locationSelect");
const respSelect = document.getElementById("respSelect");
const levelSelect = document.getElementById("levelSelect");
const participantSelect = document.getElementById("participantSelect");
const trainerSelect = document.getElementById("trainerSelect");
const participantDisplayableList = document.getElementById("participantList");
const initiatorDisplayableList = document.getElementById("initiatorList");
const submit = document.getElementById("submit");

let trainersList = [];
let participantList = [];
let participantsList = [];
const locationsList = await axios
    .get("/api/locations")
    .then((response) => response.data);
const respList = await axios
    .get("/api/trainers")
    .then((response) => response.data);
const levelsList = await axios
    .get("/api/levels")
    .then((response) => response.data);

const clearSelect = (select) => {
    select.innerHTML = "";
};

levelSelect.addEventListener("change", async (e) => {
    participantsList = await axios
        .get("/api/participants", {
            params: {
                level_id: e.target.value,
            },
        })
        .then((response) => response.data);
    clearSelect(participantSelect);
    fillSelect(
        participantSelect,
        participantsList,
        "user_id",
        "user_firstname"
    );
});

const fillSelect = (select, dataList, valueField, textField) => {
    const defaultOption = document.createElement("option");
    defaultOption.value = "default";
    defaultOption.text = "Please select an option";
    defaultOption.selected = true;
    select.appendChild(defaultOption);
    dataList.forEach((data) => {
        const option = document.createElement("option");
        option.value = data[valueField];
        if (textField === "user_firstname") {
            option.text = data[textField] + " " + data["user_lastname"];
        } else {
            option.text = data[textField];
        }
        select.appendChild(option);
    });
};

respSelect.addEventListener("change", async (e) => {
    initiatorDisplayableList.innerHTML =
        "<li>" + respSelect.options[respSelect.selectedIndex].text + "</li>";
    trainersList.push({
        user_id: respSelect.value,
        user_firstname: respSelect.options[respSelect.selectedIndex].text,
    });
});

const initialize = () => {
    fillSelect(respSelect, respList, "user_id", "user_firstname");
    fillSelect(levelSelect, levelsList, "leve_id", "leve_name");
    fillSelect(locationSelect, locationsList, "site_id", "site_name");
    fillSelect(trainerSelect, respList, "user_id", "user_firstname");
};

trainerSelect.addEventListener("change", async (e) => {
    if (trainerSelect.value === "default") return;
    const trainer = {
        user_id: trainerSelect.value,
        user_firstname: trainerSelect.options[trainerSelect.selectedIndex].text,
    };
    trainersList.push(trainer);
    updateTrainerList();
});

participantSelect.addEventListener("change", async (e) => {
    if (participantSelect.value === "default") return;
    const participant = {
        user_id: participantSelect.value,
        user_firstname:
            participantSelect.options[participantSelect.selectedIndex].text,
    };
    participantList.push(participant);
    updateParticipantList();
});

const updateTrainerList = () => {
    if (trainerSelect.value === "default") return;
    initiatorDisplayableList.innerHTML = trainersList
        .map(
            (trainer, index) =>
                `<li class="hover:text-red-500 transition-all cursor-pointer" data-index="${index}">${trainer.user_firstname}</li>`
        )
        .join("");
    initiatorDisplayableList.querySelectorAll("li").forEach((li) => {
        li.addEventListener("click", () => {
            const index = li.getAttribute("data-index");
            trainersList.splice(index, 1);
            updateTrainerList();
        });
    });
};

const updateParticipantList = () => {
    if (participantSelect.value === "default") return;
    participantDisplayableList.innerHTML = participantList
        .map(
            (participant, index) =>
                `<li data-index="${index}" class="hover:text-red-500 transition-all cursor-pointer">${participant.user_firstname}</li>`
        )
        .join("");
    participantDisplayableList.querySelectorAll("li").forEach((li) => {
        li.addEventListener("click", () => {
            const index = li.getAttribute("data-index");
            participantList.splice(index, 1);
            updateParticipantList();
        });
    });
};

initialize();

submit.addEventListener("click", async (e) => {
    e.preventDefault();

    if (
        locationSelect.value === "default" ||
        levelSelect.value === "default" ||
        respSelect.value === "default"
    ) {
        alert("Please select all required fields");
        return;
    }

    if (trainersList.length === 0) {
        alert("Please select at least one trainer");
        return;
    }

    if (participantList.length === 0) {
        alert("Please select at least one participant");
        return;
    }

    if (participantList.length / 2 !== trainersList.length) {
        console.log(participantList.length);
        alert("Il doit y avoir 2 participants par formateur");
        return;
    }

    if (
        levelSelect.value >
        respList.find((resp) => resp.user_id == respSelect.value)
            .instructor_required_level_id
    ) {
        alert("Le niveau de l'intervenant n'est pas correct");
        return;
    }

    let trainerLevelCorrect = true;
    trainersList.forEach((trainer) => {
        if (
            levelSelect.value <
            respList.find((resp) => resp.user_id == trainer.user_id)
                .instructor_required_level_id
        ) {
            trainerLevelCorrect = false;
        }
    });
    if (!trainerLevelCorrect) {
        alert("Le niveau de l'intervenant n'est pas correct");
        return;
    }

    let participantLevelCorrect = true;
    participantList.forEach((participant) => {
        if (
            levelSelect.value - 1 !=
            participantsList.find((p) => participant.user_id == p.user_id)
                .leve_id
        ) {
            participantLevelCorrect = false;
        }
    });
    if (!participantLevelCorrect) {
        alert("Le niveau du participant n'est pas correct");
        return;
    }

    const course = {
        location_id: locationSelect.value,
        level_id: levelSelect.value,
        responsable: respSelect.value,
        trainers: trainersList,
        participants: participantList,
    };

    axios
        .post("/api/courses", course)
        .then((response) => {
            console.log(response);
            listCourse.style.display = "block";
            createCourseForm.style.display = "none";
            location.reload();
        })
        .catch((error) => {
            console.log(error);
        });
});
