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

    def ubicacion(self,ubicacion):
        print("Ingresando ubicación...")
        self._fill_input_field("input[name='ubicacion']",ubicacion)
        print("Ubicación ingresada.")

    def descripcion(self,descripcion):
        print("Ingresando descripción...")
        self._wait_and_fill("//textarea[@name='descripcion']",descripcion)
        print("Descripción ingresada.")
        self.driver.execute_script("window.scrollBy(0, 500);")

    def areas_afectadas(self, indice):
        print(f"Seleccionando área afectada en el índice: {indice}...")
        self._wait_and_select_by_index("//select[@class='form-control' and @id='activos']", indice)
        print("Área afectada seleccionada.")

    def procesos_afectados(self, indice):
        print(f"Seleccionando proceso afectado en el índice: {indice}...")
        self._wait_and_select_by_index("//select[@class='form-control' and @id='activos']", indice)
        print("Proceso afectado seleccionado.")


    def _wait_and_select_by_index(self, selector, indice):
        try:
            select_element = self.wait.until(EC.visibility_of_element_located((By.XPATH, selector)))
            select_element.click()
            # Esperamos un momento para que se carguen las opciones
            self.wait.until(EC.visibility_of_element_located((By.XPATH, f"{selector}/option")))
            option_xpath = f"({selector}/option)[{indice + 1}]"  # Sumamos 1 porque los índices en XPath comienzan en 1
            option = self.wait.until(EC.visibility_of_element_located((By.XPATH, option_xpath)))
            option.click()
        except TimeoutException:
            raise TimeoutError(f"No se pudo encontrar el elemento en {selector}")

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()

    def _wait_and_select(self, selector, opcion):
        try:
            select_element = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, selector)))
            select_element.click()
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
