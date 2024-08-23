import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Create_Crear_Areas:
    
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
        
        #Modulo Configurar Organizacion
        print("Ingresando a Modulo Configurar Organizacion ...")
        in_modulo = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_modulo))
        )
        in_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Grupo de Areas
        print("Ingresando a Submenu Grupo de Areas ...")
        sub_modulo= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)



    ########################################## Agregar Crear Areas

    def add_crear_areas(self, agregar_btn_xpath, guardar_xpath):
    
        # Dando clic en Boton Agregar Area
        print("Dando clic al botón Agregar Crear Areas...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Nombre del Area
        print("Llenando nombre der Area...")
        campo_area = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='area']"))
            )
        campo_area.click()
        campo_area.send_keys("Area de Prueba 000001117")

        time.sleep(tiempo_modulos)
        
        # Nombre del Responsable
        print("Llenando nombre del responsable... ")
        campo_n_responsable = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='nombre_contacto_puesto']"))
            )
        campo_n_responsable.click()
        campo_n_responsable.send_keys("Luis Fernando Jonathan Vargas Osornio")

        time.sleep(tiempo_modulos)
        
        # Nombre del Area a la que Reporta
        print("Asignando nombre del area a la que reporta... ")
        campo_area_reporta = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='inputGroupSelect01']"))
            )
        campo_area_reporta.click()
        time.sleep(tiempo_modulos)
        campo_area_reporta.send_keys("Arquitectura")
        time.sleep(tiempo_modulos)
        campo_area_reporta.click()

        time.sleep(tiempo_modulos)
        
        # Nombre del Grupo
        print("Asignando nombre del grupo... ")
        campo_grupo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_grupo']"))
            )
        campo_grupo.click()
        time.sleep(tiempo_modulos)
        campo_grupo.send_keys("Grupo Operativo")
        time.sleep(tiempo_modulos)
        campo_grupo.click()

        time.sleep(tiempo_modulos)
        
        # Descripcion
        print("Llenando descripcion del apartado...")
        campo_descripcion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
            )
        campo_descripcion.click()
        campo_descripcion.send_keys("Descripcion de Prueba")

        time.sleep(tiempo_modulos)
        
        # Guardar
        print("Guardando repositorio creado... ")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

        