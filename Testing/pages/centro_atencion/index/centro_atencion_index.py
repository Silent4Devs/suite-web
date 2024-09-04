import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password


class CentroAtencionIndex:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 20)

    def login(self):
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


    def open_menu(self):
        print("Abriendo menú...")
        self._click_element("//button[@class='btn-menu-header']")
        print("Menú abierto.")

    def navigate_to_centro_atencion(self):
        print("Navegando al Centro de Atención...")
        self._click_element("//a[@href='https://192.168.9.78/admin/desk' and normalize-space()='Centro de atención']")
        print("Página del Centro de Atención cargada.")

    def click_incidentes_module(self):
        print("Haciendo clic en el módulo de incidentes...")
        self._wait_and_click("//a[contains(@data-tabs,'incidentes')]")
        print("Módulo de incidentes seleccionado.")

    def click_riesgos_module(self):
        print("Haciendo clic en el módulo de riesgos...")
        self._wait_and_click("//a[contains(@data-tabs,'riesgos')]")
        print("Módulo de riesgos seleccionado.")

    def click_quejas_module(self):
        print("Haciendo clic en el módulo de quejas...")
        self._wait_and_click("//a[@data-tabs='quejas']")
        print("Módulo de quejas seleccionado.")

    def click_quejas_clientes_module(self):
        print("Haciendo clic en el módulo de quejas de clientes...")
        self._wait_and_click("//a[contains(@data-tabs,'quejasClientes')]")
        print("Módulo de quejas de clientes seleccionado.")


    def click_denuncias_module(self):
        print("Haciendo clic en el módulo de denuncias...")
        self._wait_and_click("//a[contains(@data-tabs,'denuncias')]")
        print("Módulo de denuncias seleccionado.")


    def click_mejoras_module(self):
        print("Haciendo clic en el módulo de mejoras...")
        self._wait_and_click("//a[contains(@data-tabs,'mejoras')]")
        print("Módulo de mejoras seleccionado.")

    def click_sugerencias_module(self):
        print("Haciendo clic en el módulo de sugerencias...")
        self._wait_and_click("//a[contains(@data-tabs,'sugerencias')]")
        print("Módulo de sugerencias seleccionado.")

    '''
    def mostrar_filtro(self, value):
        print("Seleccionando filtro...")
        select_element = self.wait.until(EC.element_to_be_clickable((By.XPATH, "//SELECT[@name='tabla_mejoras_length']")))
        select = Select(select_element)
        select.select_by_value(value)
        print(f"Filtro seleccionado: {value}")
    '''


    def export_csv(self):
        print("Exportando a CSV...")
        export_csv_btn = self.wait.until(EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-file-csv')])[3]")))
        export_csv_btn.click()
        print("Exportación a CSV completada.")

    def export_excel(self):
        print("Exportando a Excel...")
        export_excel_btn = self.wait.until(EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-file-excel')])[3]")))
        export_excel_btn.click()
        print("Exportación a Excel completada.")

    def imprimir(self):
        print("Imprimiendo...")
        imprimir_btn = self.wait.until(EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-print')])[3]")))
        imprimir_btn.click()
        print("Impresión completada.")

    def pdf(self):
        print("Generando PDF...")
        pdf_btn = self.wait.until(EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-file-pdf')])[3]")))
        pdf_btn.click()
        print("PDF generado.")


    def _wait_and_click(self, xpath):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()


