import time
import pdb
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.action_chains import ActionChains
from config import username, password

class PlanTrabajo_index:
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

    def open_menu(self):
        menu_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn-menu-header']"))
        )
        print("Menú hamburguesa presionado")
        menu_btn.click()

    def plan_trabajo(self):
        plan_trabajo_btn= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//a[contains(.,'Planes de acción')]"))
        )
        print("Ingresando a Plan de trabajo")
        plan_trabajo_btn.click()

    def plan_trabajo_filtro(self):
        plan_trabajo_filtro_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//select[contains(@name,'tblPlanesAccion_length')]"))
        )
        select = Select(plan_trabajo_filtro_btn)
        select.select_by_index(1)
        print("Filtro de 10 registros por página seleccionado")

    def plan_trabajo_searchbar(self, search):
        plan_trabajo_searchbar = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//input[contains(@class,'form-control form-control-sm')]"))
        )
        plan_trabajo_searchbar.clear()
        plan_trabajo_searchbar.send_keys(search)
        print("Búsqueda realizada")

    def plan_trabajo_paginador(self):
        paginado1 = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'1')]"))
        )
        paginado1.click()

        paginado2 = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'2')]"))
        )
        paginado2.click()
        print("Paginado realizado")

    def plan_trabajo_opciones(self):
        opciones_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "(//button[contains(@class,'btn btn-option')])[1]"))
        )
        opciones_btn.click()
        print("Opciones presionadas")

    def plan_trabajo_editar(self):
        url_ventana_principal = self.driver.current_url
        url_editar = "https://192.168.9.78/admin/planes-de-accion/11/edit"

        self.driver.execute_script(f"window.open('{url_editar}','_blank');")
        print("Botón de editar presionado y nueva pestaña abierta en segundo plano")
        print("URL de Editar:", url_ventana_principal)

    def plan_trabajo_ver_plan(self):
        url_ventana_principal2 = self.driver.current_url
        url_ver = "https://192.168.9.78/admin/planes-de-accion/11"

        self.driver.execute_script(f"window.open('{url_ver}','_blank');")
        print("Botón de ver plan presionado y nueva pestaña abierta en segundo plano")
        print("URL de Ver plan:", url_ventana_principal2)

    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()



