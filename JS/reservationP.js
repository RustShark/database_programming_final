const id_board = document.querySelector('#ip_boarding_id');
const name_board = document.querySelector('#ip_boarding_name');
const id_arrive = document.querySelector('#ip_arriving_id');
const name_arrive = document.querySelector('#ip_arriving_name');
const swap_btn = document.querySelector('#swap_btn');
const hid_board = document.querySelector('#hid_board');
const hid_arrive = document.querySelector('#hid_arrive');

const short = ["ICN", "SIN", "NRT", "LHR", "MUC", "ZRH", "CPH", "YVR", "SYD", "DEN"];
const name = ["Incheon", "Singapore", "Tokyo", "London", "Munich", "Zurich", "Copenhagen", "Vancouver", "Sydney", "Denver"];

swap_btn.addEventListener('click', e => {
    var tmp1 = id_board.innerHTML;
    var tmp2 = name_board.innerHTML;
    var tmp3 = hid_board.value;
    
    id_board.innerHTML = id_arrive.innerHTML;
    name_board.innerHTML = name_arrive.innerHTML;
    id_arrive.innerHTML = tmp1;
    name_arrive.innerHTML = tmp2;
    hid_board.value = hid_arrive.value;
    hid_arrive.value = tmp3;
})

function input_board() {
    const label_text = document.querySelector('#label_boarding');
    const label_btn = document.querySelector('#label_boarding_submit');

    if(label_text.value != false) {
        for(var i = 0; i < 10; i++) {
            if(label_text.value == name[i]) {
                id_board.innerHTML = short[i];
                name_board.innerHTML = name[i];
                hid_board.value = short[i];
                break;
            }
        }
    }
    else {
        alert("똑바로 입력하시오");
    }
}

function input_arrive() {
    const label_text = document.querySelector('#label_arriving');
    const label_btn = document.querySelector('#label_arriving_submit');

    if(label_text.value != false) {
        for(var i = 0; i < 10; i++) {
            if(label_text.value == name[i]) {
                id_arrive.innerHTML = short[i];
                name_arrive.innerHTML = name[i];
                hid_arrive.value = short[i];
                break;
            }
        }
    }
    else {
        alert("똑바로 입력하시오");
    }
}