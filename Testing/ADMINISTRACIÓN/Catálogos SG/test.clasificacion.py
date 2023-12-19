from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
element_xpath0 = "//a[contains(.,'Catalogos SG')]"
clasificacion_xpath="//a[contains(.,'Clasificación')]"
crear_clasificacion_btn_xpath= "//a[contains(.,'Nueva Clasificación')]"
id_xpath="///input[contains(@type,'number')]"
save_btn_xpath="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
opciones_xpath="(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]"
editar_xpath="(//a[contains(.,'Editar')])[1]"


# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = input("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    time.sleep(tiempo_modulos)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//font[@class='letra_blanca'][contains(.,'Mi perfil')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

    #Catalogo SG
print("Entrando a Catálogo SG...")
element = driver.find_element(By.XPATH, element_xpath0)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath0)))
print("Dando clic en Catálogo SG...")
element.click()

#Clasificación
print("Entrando a Clasificación...")
clasificacion=driver.find_element(By.XPATH, clasificacion_xpath)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, clasificacion_xpath)))
print("Dando clic en Clasificación...")
clasificacion.click()

#Nueva clasificación
print("Dando clic al botón Nueva clasificación...")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
crear_clasificacion_btn = wait.until(EC.presence_of_element_located((By.XPATH, crear_clasificacion_btn_xpath)))
# Ahora intenta hacer clic en el elemento
crear_clasificacion_btn.click()

#ID
def ingresar_id(driver):
    # Obtener la entrada del usuario desde la terminal
    id_ingresado = input("Ingresa un número: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//input[contains(@type,'number')]"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(id_ingresado)

#Llamando a la función ID
ingresar_id(driver)


def ingresar_clasificacion(driver):
    # Obtener la entrada del usuario desde la terminal
    clasificacion_ingresado = input("Ingresa una clasificación: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//input[contains(@type,'text')]"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(clasificacion_ingresado)

#llamando a la función clasificación
ingresar_clasificacion(driver)

#Descripción
def ingresar_descripcion(driver):
    # Obtener la entrada del usuario desde la terminal
    descripcion_ingresado = input("Ingresa una descripción: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//textarea[contains(@class,'form-control')]"))
    )

    # Limpiar el campo de entrada y escribir la descripción ingresada por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(descripcion_ingresado)

#llamando a la función descripción
ingresar_descripcion(driver)

#Guardar
def clic_guardar(driver):
    print("Dando clic al botón Guardar...")
    # Esperar hasta que el elemento sea visible
    guardar_btn = WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.XPATH, save_btn_xpath))
    )
    guardar_btn.click()

#llamando a la función clic_guardar
clic_guardar(driver)


#Opciones
print("Dando clic al apartado Opciones...")
def realizar_accion_opciones(driver):
    # Opciones
    opciones_xpath = "(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
    opciones = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, opciones_xpath))
    )
    opciones.click()

# Llamada a la función en cualquier parte del script
realizar_accion_opciones(driver)

#Editar
print("Dando clic al botón Editar...")
def realizar_accion_editar(driver):
    # Opciones
    editar_xpath = "(//a[contains(.,'Editar')])[1]"
    editar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, editar_xpath))
    )
    editar.click()

# Llamada a la función Editar
realizar_accion_editar(driver)

#Llamando a la función ID
ingresar_id(driver)

#llamando a la función Clasificación
ingresar_clasificacion(driver)

#llamando a la función descripción
ingresar_descripcion(driver)

#llamar a la función clic_guardar
clic_guardar(driver)
