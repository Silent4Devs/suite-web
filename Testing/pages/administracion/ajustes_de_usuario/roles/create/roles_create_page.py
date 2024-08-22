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

    def in_submodulo(self, menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo):
    
        time.sleep(tiempo_modulos)
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(5)
        
        #Modulo Ajuste de Usuario
        print("Ingresando a Modulo Ajuste de Usuario ...")
        in_modulo = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_modulo))
        )
        in_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Roles
        print("Ingresando a Submodulo Roles ...")
        sub_modulo= WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(5)
        
        print("URL actual:", self.driver.current_url)



    ########################################## Agregar 

    def add_roles(self, agregar_btn_xpath, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Agregar Rol
        print("Dando clic al botón Agregar Crear Rol...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Nombre de Rol
        
        campo_n_rol = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='title']"))
            )
        campo_n_rol.click()
        campo_n_rol.send_keys("Nombre de Rol de Prueba 01117")
        print("Asignando nombre de Rol")
        
        time.sleep(tiempo_modulos)

        # mi_perfil_acceder
        
        campo_n1 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[2]"))
            )
        campo_n1.click()
        print("Seleccionar campo mi_perfil_acceder")
        
        time.sleep(tiempo_modulos)

        #mi_perfil_mis_datos_acceder
        
        campo_n2 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[3]"))
            )
        campo_n2.click()
        print("Seleccionar campo mi_perfil_mis_datos_acceder")
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mis_datos_ver_perfil_de_puesto
        
        campo_n3 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[5]"))
            )
        campo_n3.click()
        print("Seleccionar campo mi_perfil_mis_datos_ver_perfil_de_puesto")
        
        time.sleep(tiempo_modulos)

        # Seleccionar opcion 3 de carrusel
        
        campo_n4 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//A[@href='#'][text()='3']"))
            )
        campo_n4.click()
        print("Seleccionar opcion 3 de carrusel")
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mis_datos_ver_mis_competencias
        
        campo_n5 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[1]"))
            )
        campo_n5.click()
        print("Seleccionar campo mi_perfil_mis_datos_ver_mis_competencias")
        
        time.sleep(tiempo_modulos)
        
        # mi_perfil_mi_calendario_acceder
        
        campo_n6 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//TD[@class=' select-checkbox'])[3]"))
            )
        campo_n6.click()
        print("Seleccionar campo mi_perfil_mi_calendario_acceder")
        
        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
                        