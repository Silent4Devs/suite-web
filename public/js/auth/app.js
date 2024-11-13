console.log(`
    _______         ____            _   _  _______             _
   |__   __| /\\    |  _ \\    /\\    | \\ | ||__   __| /\\        | |
      | |   /  \\   | |_) |  /  \\   |  \\| |   | |   /  \\       | |
      | |  / /\\ \\  |  _ <  / /\\ \\  | . \` |   | |  / /\\ \\  _   | |
      | | / ____ \\ | |_) |/ ____ \\ | |\\  |   | | / ____ \\| |__| |
      |_|/_/    \\_\\|____//_/    \\_\\|_| \\_|   |_|/_/    \\_\\\\____/

                                                                 `);

document.querySelector("body").addEventListener("click", () => {
    document.querySelector("body").classList.remove("animate-active");
});

document.getElementById("btn_modal_aviso").addEventListener("click", () => {
    document.getElementById("modal_aviso").classList.add("visible");
});

document.getElementById("btn_closed_modal").addEventListener("click", () => {
    document.getElementById("modal_aviso").classList.remove("visible");
});
