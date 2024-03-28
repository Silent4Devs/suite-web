import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import Select
import pdb
from config import username, password


class IncidentesCreate:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 10)

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

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()

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

    def crear_reporte(self):
        print("Navegando a la creación de reporte...")
        self._click_element("//a[@href='https://192.168.9.78/admin/inicioUsuario/reportes/seguridad']")
        print("Página de creación de reporte cargada.")


    def titulo_incidente(self, titulo):
        print("Ingresando título del incidente...")
        self._fill_input_field("input[name='titulo']", titulo)
        print("Título del incidente ingresado.")

    def seleccionar_fecha(self, fecha):
        print("Seleccionando fecha...")
        self._wait_and_fill("//input[@type='datetime-local' and @name='fecha']", fecha)
        print("Fecha seleccionada.")


    def sede(self, opcion):
        print(f"Seleccionando opción '{opcion}' en el select...")
        self._wait_and_select("select[name='sede']", opcion)
        print("Opción seleccionada.")
        pdb.set_trace()
    def _wait_and_select(self, selector, opcion):
        try:
            select_element = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, selector)))
            select_element.click()  # Hacer clic en el select para abrir las opciones

            # Esperar a que la opción esté disponible y seleccionarla
            option_xpath = f"//select[@name='sede']/option[text()='{opcion}']"
            option = self.wait.until(EC.visibility_of_element_located((By.XPATH, option_xpath)))
            option.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {selector}")

    def _wait_and_click(self, xpath):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")

    def _wait_and_fill(self, xpath, value):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.clear()
            element.send_keys(value)
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")
