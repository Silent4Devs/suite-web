import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Create_Roles:
    
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 10)

    def login(self):
        
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("Iniciando sesión en el sistema...")
        time.sleep(4)
        self._fill_input_field("input[name='email']", username_c)
        self._fill_input_field("input[name='password']", password_c)
        self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
        print("¡Sesión iniciada con éxito!")
        self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
        print("Login correcto.")
        
        print("URL actual:", self.driver.current_url)
        
        time.sleep(tiempo_modulos)
        
    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()

    def _wait_and_fill(self, xpath, value):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.clear()
            element.send_keys(value)
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")
        
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


    ##########################################Entrar a Modulo y Submodulo

    def ruta_roles_index(self, url_apartado_index):
        try:
            self.driver.get(url_apartado_index)
            print("Index de Ajuste de Usuario / Roles")
        except Exception as e:
            print("Error al cargar el index de Ajuste de Usuario / Roles", e)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar 

    def add_roles(self, agregar_btn_xpath, rol, mi_perfil, mis_datos, perfil_de_puesto , carrusel, mis_competencias, calendario, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Agregar Rol
        print("Dando clic al botón Agregar Crear Rol...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Nombre de Rol
        print("Asignando nombre de Rol")
        campo_n_rol = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, rol))
            )
        campo_n_rol.click()
        campo_n_rol.send_keys("Nombre de Rol de Prueba 01117")
        
        
        time.sleep(tiempo_modulos)

        # mi_perfil_acceder
        print("Seleccionar campo mi_perfil_acceder")
        campo_n1 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, mi_perfil ))
            )
        campo_n1.click()
        
        time.sleep(tiempo_modulos)

        #mi_perfil_mis_datos_acceder
        print("Seleccionar campo mi_perfil_mis_datos_acceder")
        campo_n2 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, mis_datos))
            )
        campo_n2.click()
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mis_datos_ver_perfil_de_puesto
        print("Seleccionar campo mi_perfil_mis_datos_ver_perfil_de_puesto")
        campo_n3 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, perfil_de_puesto))
            )
        campo_n3.click()
        
        
        time.sleep(tiempo_modulos)

        # Seleccionar opcion 3 de carrusel
        print("Seleccionar opcion 3 de carrusel")
        campo_n4 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, carrusel))
            )
        campo_n4.click()
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mis_datos_ver_mis_competencias
        print("Seleccionar campo mi_perfil_mis_datos_ver_mis_competencias")
        campo_n5 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, mis_competencias))
            )
        campo_n5.click()
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mi_calendario_acceder
        print("Seleccionar campo mi_perfil_mi_calendario_acceder")
        campo_n6 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, calendario))
            )
        campo_n6.click()
        
        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        print("URL actual:", self.driver.current_url)
        
                        