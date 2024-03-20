import time
import pdb
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.action_chains import ActionChains

class PlanTrabajo_index:
    def __init__(self, driver):
        self.driver = driver

    def login(self, username, password):
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ LOGIN - TABANTAJ -----")
        time.sleep(5)
        username_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
        )
        username_input.clear()
        username_input.send_keys(username)
        print("Usario ingresado")

        password_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
        )
        password_input.clear()
        password_input.send_keys(password)
        print("Contraseña ingresada")

        submit_button = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
        )
        submit_button.click()
        print("Enviando credenciales de acceso")

        WebDriverWait(self.driver, 2).until(
            EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']"))
        )
        print("Login correcto")

    def open_menu(self):
        menu_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn-menu-header']"))
        )
        menu_btn.click()

    def plan_trabajo(self):
        plan_trabajo_btn= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//a[contains(.,'Planes de acción')]"))
        )
        plan_trabajo_btn.click()

    def plan_trabajo_filtro(self):
        plan_trabajo_filtro_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//select[contains(@name,'tblPlanesAccion_length')]"))
        )
        select = Select(plan_trabajo_filtro_btn)
        select.select_by_index(1)

    def plan_trabajo_searchbar(self, search):
        plan_trabajo_searchbar = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//input[contains(@class,'form-control form-control-sm')]"))
        )
        plan_trabajo_searchbar.clear()
        plan_trabajo_searchbar.send_keys(search)

    def plan_trabajo_paginador(self):
        paginado1 = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'1')]"))
        )
        paginado1.click()

        paginado2 = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'2')]"))
        )
        paginado2.click()

    def plan_trabajo_opciones(self):
        opciones_btn = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "(//button[contains(@class,'btn btn-option')])[1]"))
        )
        opciones_btn.click()

    def plan_trabajo_editar(self):
        url_ventana_principal = self.driver.current_url
        url_editar = "https://192.168.9.78/admin/planes-de-accion/11/edit"

        self.driver.execute_script(f"window.open('{url_editar}','_blank');")
        print("Botón de editar presionado y nueva pestaña abierta en segundo plano")
        print("URL actual:", url_ventana_principal)




