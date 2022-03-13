# 1주차 미션 - basic crud

## 환경 세팅

-   windows10
-   docker windows
-   docker ubuntu 20
-   composer 2
-   nvm - node 14 lts
-   mysql 8

## tailwind 설치

-   https://tailwindcss.com/docs/guides/laravel
-   https://tailwindcss.com/docs/configuration

```
npx tailwindcss init --full
```

## key-generate, .env configuration, migration check and rollback

## test code write

-   factory
-   seed
-   feature test

## search with scout

-   https://docs.meilisearch.com/
-   https://laracasts.com/series/learn-laravel-scout

```
    php artisan scout:import "App\Models\Article"
```

## Rest API?

-   현실적으로 너무 어려움
-   HTTP API 로 일단 만들고, 공부를 좀 더 해봅시다.
    http://slides.com/eungjun/rest#/1
    https://www.iana.org/form/media-types

## 5주차... 뭐 하지?
- jenkins test...
```
cd /var/lib/jenkins/workspace/taling/week_5
composer install
cp /docker/html/taling/src_b/current/.env /var/lib/jenkins/workspace/taling/week_5
/usr/bin/php8.1 artisan test

/home/jenkins/.nvm/versions/node/v14.19.0/bin/npm install
/home/jenkins/.nvm/versions/node/v14.19.0/bin/npx mix --production

cd /docker/html/taling/src

rm -rf /docker/html/taling/src_b/current
mv /docker/html/taling/src/current /docker/html/taling/src_b/
mv /var/lib/jenkins/workspace/taling/week_5 /docker/html/taling/src/
mv week_5 current

cd current
chmod 777 -R storage/*
```
### 문제점
- docker composer 를 통해 배포한 컨테이너는 기존에 이미 설치한 다른 네트워크의 젠킨스와 바로 연결되지 않는다.
- 개인용 NAS에 올리는 용도의 젠킨스로는 여러 버전의 php, 여러 버전의 npm이 필요하다.

### volume을 이용한 폴더 공유
- 다만 이 문제는 한번 볼륨으로 정한 폴더는 이후 삭제/변형 후 같은 이름으로 다시 연결해도 컨테이너는 이를 기존 볼륨으로 인식하지 않는다.
- 반대로 한번 볼륨으로 정한 폴더 자체만 유지되면, 폴더 안의 내용이 컨테이너 밖에서 바뀌어도 영향을 받는다.
- 이점을 응용해서 nginx 설정을 /var/www/html/public 이 아니라, 한단계 더 깊이 참조하도록 하였고,
- 볼륨에는 src에 바로 라라벨 소스를 주는 것이 아니라 폴더로 한번 깜싸서 넣는다.

- 빌드가 실패하면 기존의 폴더를 current로 유지한다.

- 빌드가 성공하면 옛날 current를 일단 날리고
- 현재 current를 옛날 src_b로 넣는다.
- 빌드가 끝난 새 소스를 src로 가져와 current로 바꾼다.
- 스토리지 로그 등의 퍼미션을 열어준다.

### /urs/bin 미인식, 여러 버전의 프로그램 사용
- 개인적으로는 젠킨스 자체보다 리눅스가 편해서 이렇게 하였음을 미리 알림
- 리눅스에 php8.0, php8.1, nvm 을 깔고
- 컨테이너 안에서는 계정이 디폴트가 root로 잡히므로 nvm등이 root 기준으로 설치됨
- nvm은 조정이 좀 필요하고, php는 버전졀로 /usr/bin/php/8.1 이런식으로 있으므로 이를 응용
- npm, npx 등 ubuntu 상에서는 short cut이 가능한 것들도 전부 which를 통해 full path를 알아내어 젠킨스 빌드 스크립트를 짜줘야 한다.
- 다만 실험은 안해봤지만, 이건 무식하게 일단 무작정 한 것이고, 아마도 원칙적으로는 젠킨스의 플러그인을 설치 후 응용하면 편했을 수도 있었을 것 같다...

### tip
- 빌드 하고 테스트 하고 성공하면 prod 위치에서 다시 git으로 가져오고 빌드하고?
- 성공한 빌드를 가져와 걍 쓰면 된다. 물론 젠킨스가 원격지에 있으면 더 편하고 빠른방법으로 하면 되고...


# test for jenkins
