import time
import pdb
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from config import username, password
class Requisiciones_index:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self):
        try:
            self.driver.get('https://192.168.9.78/')
            self.driver.maximize_window()
            print("Iniciando sesión en el sistema...")
            time.sleep(4)
            self._fill_input_field("input[name='email']", username)
            self._fill_input_field("input[name='password']", password)
            self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
            print("¡Sesión iniciada con éxito!")
            self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
            print("Login correcto.")
        except Exception as e:
            print("Error durante el inicio de sesión:", e)
        print("Login correcto")

    def open_menu(self):
        menu_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn-menu-header']"))
        )
        menu_btn.click()

    def go_to_gestion_contractual(self):
        gestion_contractual_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//a[@href='https://192.168.9.78/contract_manager/katbol']"))
        )
        time.sleep(0.2)
        gestion_contractual_btn.click()
        print("Botón de Gestion Contractual presionado")
        print("URL actual:", self.driver.current_url)

    def requisiciones_module(self):
        requisiciones_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//a[contains(.,'Requisiciones')]"))
            )
        requisiciones_btn.click()
        print("Botón de Requisiciones presionado")
        print("URL actual:", self.driver.current_url)

    def requisiciones_filtro(self):
        requisiciones_filtro_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//select[@name='dom_length']"))
        )
        select = Select(requisiciones_filtro_btn)
        select.select_by_index(2)

    def requisiciones_searchbar(self, search):
        search_bar = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//input[@type='search' and contains(@class, 'form-control')]"))
        )
        search_bar.clear()
        search_bar.send_keys(search)
        print("Búsqueda realizada")

    def requisiciones_aprobadores(self):
        url_ventana_principal = self.driver.current_url
        url_aprobadores = "https://192.168.9.78/contract_manager/requisiciones/aprobadores?_method=GET"

        self.driver.execute_script(f"window.open('{url_aprobadores}','_blank');")
        print("Botón de Aprobadores presionado y nueva pestaña abierta en segundo plano")
        print("URL actual:", url_ventana_principal)

    def requisiciones_archivados(self):
        url_archivados=self.driver.current_url
        url_archivados = "https://192.168.9.78/contract_manager/requisiciones/archivo"
        self.driver.execute_script(f"window.open('{url_archivados}','_blank');")
        print("URL actual:", url_archivados)


    def requisiciones_download_csv(self):
        export_csv_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//i[contains(@class,'fas fa-file-csv')]"))
        )
        export_csv_btn.click()
        print("Botón de Exportar CSV presionado")
        print("URL actual:", self.driver.current_url)

    def requisiciones_download_excel(self):
        export_excel_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//i[contains(@class,'fas fa-file-excel')]"))
        )
        export_excel_btn.click()
        print("Botón de Exportar Excel presionado")
        print("URL actual:", self.driver.current_url)

    def requisiciones_download_pdf(self):
        export_pdf_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//i[contains(@class,'fas fa-file-pdf')]"))
        )
        export_pdf_btn.click()
        print("Botón de Exportar PDF presionado")
        print("URL actual:", self.driver.current_url)

    def requisiciones_print(self):
        print_btn = WebDriverWait(self.driver, 5).until(
            EC.element_to_be_clickable((By.XPATH, "//i[contains(@class,'fas fa-print')]"))
        )
        print_btn.click()
        print("Botón de Imprimir presionado")
        print("URL actual:", self.driver.current_url)

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()


