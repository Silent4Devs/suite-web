import time
import pytest
import pdb
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support.ui import Select
#CLASE PRINCIPAL
class CapacitacionesPage:
    def __init__(self, driver):
        self.driver = driver
    #LOGIN DE TABANTAJ
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
        print("Usuario ingresado")

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
    #MENÚ HAMBURGUESA
    def open_menu(self):
        menu_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//button[@class='btn-menu-header']"))
        )
        menu_btn.click()
    #CAPACITACIONES
    def go_to_capacitaciones(self):
        capacitaciones_btn = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//a[@href='https://192.168.9.78/admin/capacitaciones-inicio']"))
        )
        time.sleep(0.5)
        capacitaciones_btn.click()
        print("Botón de capacitaciones presionado")
        print("URL actual:", self.driver.current_url)

    #MIS CURSOS OPTION
    def mis_cursos(self):
        mis_curso_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, '//a[@href="https://192.168.9.78/admin/mis-cursos"]'))
        )
        mis_curso_btn.click()
        print("Entrando a mis cursos")
        print("URL actual:", self.driver.current_url)

    #CATÁLOGO DE CURSOS
    def primer_filtro(self):
        primer_filtro_btn = WebDriverWait(self.driver, 5).until(
        EC.visibility_of_element_located((By.XPATH, "//select[@name='todo' and @id='todoSelect']"))
    )
        primer_filtro_btn.click()
        time.sleep(1)
    def segundo_filtro(self):
        segundo_filtro_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//select[@name='category' and @id='categorySelect']"))
        )
        select = Select(segundo_filtro_btn)
        select.select_by_index(2)

    def tercer_filtro(self):
        tercer_filtro_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, "//select[@name='level' and @id='levelSelect']"))
        )
        select = Select(tercer_filtro_btn)
        select.select_by_index(3)
        pdb.set_trace()
















