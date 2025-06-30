from pathlib import Path
import os  # ✅ Needed for static paths

BASE_DIR = Path(__file__).resolve().parent.parent

SECRET_KEY = 'django-insecure-8gix7=iaczwja2mp*fzkf=&t_wxifstia@*eu+jit5ny7j-l0%'
DEBUG = True

ALLOWED_HOSTS = ['.onrender.com', 'localhost']  # ✅ Includes Render domain

# Application definition
INSTALLED_APPS = [
   
    'whitenoise.runserver_nostatic',  # ✅ Add this to disable default static handling
    'django.contrib.staticfiles',
 
]

MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'whitenoise.middleware.WhiteNoiseMiddleware',  # ✅ Add WhiteNoise here
    ...
]

ROOT_URLCONF = 'DivineKabatesi_2405001054.urls'

# Templates, database, auth — keep as-is

# ✅ Static file settings for Render + WhiteNoise
STATIC_URL = '/static/'
STATIC_ROOT = os.path.join(BASE_DIR, 'staticfiles')

STATICFILES_STORAGE = 'whitenoise.storage.CompressedManifestStaticFilesStorage'

# ✅ Optional: ensure whitenoise can serve compressed, versioned static assets

# Authentication redirects
LOGIN_URL = 'login'
LOGIN_REDIRECT_URL = 'home'
LOGOUT_REDIRECT_URL = 'login'

# Email backend (you can replace credentials later with environment variables)
EMAIL_BACKEND = 'django.core.mail.backends.smtp.EmailBackend'
EMAIL_HOST = 'smtp.gmail.com'
EMAIL_PORT = 587
EMAIL_USE_TLS = True
EMAIL_HOST_USER = 'your_email@gmail.com'
EMAIL_HOST_PASSWORD = 'your_app_password'
