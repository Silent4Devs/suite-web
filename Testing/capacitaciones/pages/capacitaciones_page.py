import time
import pytest
import pdb
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

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
    #MIS CURSOS
    def mis_cursos(self):
        mis_curso_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, '//a[@href="https://192.168.9.78/admin/mis-cursos"]'))
        )
        mis_curso_btn.click()
        print("Entrando a mis cursos")
        print("URL actual:", self.driver.current_url)
    #CURSO 1
    def course_1(self):
        course_1_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, '//a[@href="https://192.168.9.78/admin/curso-estudiante/8"]'))
            )
        course_1_btn.click()
        print("Entrando a curso 1")

        print("URL actual:", self.driver.current_url)
    #CATÁLOGO DE CURSOS
    def catalogo_cursos(self):
        catalogo_cursos_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, '//a[@href="https://192.168.9.78/admin/courses/test" and contains(text(), "MÁS INFORMACIÓN")]'))
            )
        catalogo_cursos_btn.click()
        time.sleep(5)
        print("Entrando a catalogo de cursos")
        print("URL actual:", self.driver.current_url)

        #CONTINUAR CON EL CURSO
    def tomar_curso1(self):
        tomar_curso1_btn = WebDriverWait(self.driver, 5).until(
            EC.visibility_of_element_located((By.XPATH, '//a[@class="mt-4 btn btn-mas-info-c"]'))
            )
        time.sleep(2)
        tomar_curso1_btn.click()
        print("Tomando curso 1")
        print("URL actual:", self.driver.current_url)

    def yt_video(self):
        try:
            video_element = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, '//iframe[contains(@src, "youtube.com")]'))
        )
            assert video_element.is_displayed(), "El reproductor de video de YouTube no está visible"
        except TimeoutException:
            pytest.fail("El reproductor de video de YouTube no se encontró en la página")





