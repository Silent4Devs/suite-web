import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.evaluacion360.seguimiento.evaluaciones360_seguimiento_page import Evaluaciones360Seguimiento
from config import username, password

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    # options = ChromeOptions()
    options.add_argument('--headless')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    options.add_argument('--disable-extensions')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--disable-browser-side-navigation')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--log-level=3')

    #driver = webdriver.Chrome(options=options)
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()

def test_evaluaciones360_seguimiento(browser):
    evaluaciones360_seguimiento = Evaluaciones360Seguimiento(browser)
    username_input = "input[name='email']"
    password_input = "input[name='password']"
    btn_enviar = "//button[@type='submit'][contains(text(),'Enviar')]"
    logo="img[alt='Logo Tabantaj']"
    evaluaciones360_seguimiento.login(logo,btn_enviar,username_input,password_input)

    seguimiento_index = "https://192.168.9.78/admin/recursos-humanos/evaluacion-360/evaluaciones"
    evaluaciones360_seguimiento.cap_humano_index(seguimiento_index)

    select = "//select[@name='DataTables_Table_0_length']"
    evaluaciones360_seguimiento.mostrar_select(select)

    csv = "//i[@class='fas fa-file-csv']"
    evaluaciones360_seguimiento.csv_download(csv)

    excel= "//i[@class='fas fa-file-excel']"
    evaluaciones360_seguimiento.excel_download(excel)

    pdf = "//i[@class='fas fa-file-pdf']"
    evaluaciones360_seguimiento.pdf_download(pdf)

    imprimir = "//i[@class='fas fa-print']"
    evaluaciones360_seguimiento.imprimir(imprimir)

    search_bar = "//input[@type='search' and @class='form-control form-control-sm']"
    credential = "Registro1"
    evaluaciones360_seguimiento.searchbar(search_bar,credential)
