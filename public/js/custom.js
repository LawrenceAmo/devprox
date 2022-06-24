function redirect(url) {
    location.href = url;
}
function showPassword(id) {
    let x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
// get month as three (3) letter abbr (where n is the current index(month) user want)
const getMonth = (monthFromNow = 0) => {
    const months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];
    let d = new Date();
    let n = d.getMonth();
    n += monthFromNow;
    if (n < 0) {
        while (n < 0) {
            n += 12;
        }
    } else if (n > 11) {
        while (n > 11) {
            n -= 12;
        }
    } else {
        n = n;
    }
    return months[n];
};
// get month as three 3 letter abbr (where n is the current index user want)
const getDay = (dayFromNow = 0) => {
    const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
    let d = new Date();
    let n = d.getDay() - 1;
    n += dayFromNow;
    if (n < 0) {
        while (n < 0) {
            n += 7;
        }
    } else if (n > 6) {
        while (n > 6) {
            n -= 7;
        }
    } else {
        n = n;
    }
    return days[n];
};

//// get time difference (hours and minutes are required) e.g "20:13:52"
function get_time_diff(start_time, end_time) {
    var d = new Date();
    let date = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();

    let time_start = new Date(`${date} ${start_time}`);
    let time_end = new Date(`${date} ${end_time}`);

    let time_diff = Math.abs(time_start.getTime() - time_end.getTime());

    let hh = Math.floor(time_diff / 1000 / 60 / 60);
    hh = ("0" + hh).slice(-2);

    time_diff -= hh * 1000 * 60 * 60;
    let mm = Math.floor(time_diff / 1000 / 60);
    mm = ("0" + mm).slice(-2);

    time_diff -= mm * 1000 * 60;
    let ss = Math.floor(time_diff / 1000);
    ss = ("0" + ss).slice(-2);

    return hh + ":" + mm + ":" + ss;
}

// custom library like pythone
function print(param) {
    return console.log(param);
}
function createElemet(param) {
    return document.createElement(param);
}
function getElemet(param, type) {
    if (type === "#") {
        return document.getElementById(param);
    }
}

function genderName(param) {
    let gender = param.toLowerCase();
    if (gender === "m") return "Male";
    if (gender === "f") return "Female";
    return "Other";
}
function genderSym(param) {
    let gender = param.toLowerCase();
    if (gender === "male" || gender === "m") return "M";
    if (gender === "female" || gender === "m") return "F";
    return "Other";
}
function zoomWebSite() {
    document.body.style.zoom = "90%";
}

// Authentication for WEB API User
let get_cookie = (name) => {
    var cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
};
let auth_getCookies = () => {
    let access_token = get_cookie("access_token");
    let secret_token = get_cookie("secret_token");
    if (access_token !== null) {
        if (access_token.length > 10 || secret_token.length > 10) {
            localStorage.setItem("access_token", access_token);
            localStorage.setItem("secret_token", secret_token);
        }
    }
};
auth_getCookies();

const auth_setCookies = () => {
    let access_token = localStorage.getItem("access_token");
    let secret_token = localStorage.getItem("secret_token");
    return {
        access_token,
        secret_token,
    };
};
let webApi_auth_user = auth_setCookies();
let access_token = webApi_auth_user["access_token"];
let secret_token = webApi_auth_user["secret_token"];
